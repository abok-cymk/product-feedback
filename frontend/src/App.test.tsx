import { QueryClient, QueryClientProvider } from "@tanstack/react-query"
import { fireEvent, render, screen, waitFor } from "@testing-library/react"
import { MemoryRouter } from "react-router"
import { describe, expect, it, beforeEach, vi } from "vitest"

import App from "./App"

const mockProducts = {
  data: [
    {
      id: 1,
      name: "First product",
      description: "First product description.",
    },
  ],
}

function renderApp(initialEntry: string) {
  const queryClient = new QueryClient({
    defaultOptions: {
      queries: {
        retry: false,
      },
    },
  })

  return render(
    <QueryClientProvider client={queryClient}>
      <MemoryRouter initialEntries={[initialEntry]}>
        <App />
      </MemoryRouter>
    </QueryClientProvider>
  )
}

describe("App", () => {
  beforeEach(() => {
    globalThis.fetch = vi.fn().mockImplementation(() =>
      Promise.resolve({
        ok: true,
        status: 200,
        json: () => Promise.resolve(mockProducts),
      })
    ) as any
  })

  it("renders the home page", () => {
    renderApp("/")

    expect(
      screen.getByRole("heading", {
        name: "Product Feedback",
      })
    ).toBeInTheDocument()
  })

  it("renders the products page", async () => {
    renderApp("/products")

    expect(
      screen.getByRole("heading", {
        name: "Products",
      })
    ).toBeInTheDocument()

    await waitFor(() => {
      expect(
        screen.getByRole("heading", {
          name: "First product",
        })
      ).toBeInTheDocument()
    })
  })

  it("navigates to the products page", async () => {
    renderApp("/")

    fireEvent.click(
      screen.getByRole("button", {
        name: "Products",
      })
    )

    await waitFor(() => {
      expect(
        screen.getByRole("heading", {
          name: "Products",
        })
      ).toBeInTheDocument()
    })
  })

  it("renders the error fallback when products fail to load", async () => {
    const consoleSpy = vi.spyOn(console, "error").mockImplementation(() => {})

    try {
      globalThis.fetch = vi.fn().mockImplementation(() =>
        Promise.resolve({
          ok: false,
          status: 500,
          json: () =>
            Promise.resolve({
              error: "Internal Server Error",
            }),
        })
      ) as any

      renderApp("/products")

      expect(
        await screen.findByText("Unable to load products.")
      ).toBeInTheDocument()
    } finally {
      consoleSpy.mockRestore()
    }
  })
})
