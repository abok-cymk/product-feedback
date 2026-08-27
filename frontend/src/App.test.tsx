import { QueryClient, QueryClientProvider } from "@tanstack/react-query"
import { render, screen } from "@testing-library/react"
import { MemoryRouter } from "react-router"
import { describe, expect, it } from "vitest"

import App from "./App"

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
  it("renders the home page", () => {
    renderApp("/")

    expect(
      screen.getByRole("heading", {
        name: "Product Feedback",
      })
    ).toBeInTheDocument()
  })

  it("renders the products page", () => {
    renderApp("/products")

    expect(
      screen.getByRole("heading", {
        name: "Products",
      })
    ).toBeInTheDocument()
  })
})
