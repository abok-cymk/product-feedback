import { QueryClient, QueryClientProvider } from "@tanstack/react-query"
import { render, screen, waitFor } from "@testing-library/react"
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
};

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
})
