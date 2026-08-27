import { QueryClient, QueryClientProvider } from "@tanstack/react-query"
import { render, screen } from "@testing-library/react"
import { afterEach, describe, expect, it, vi } from "vitest"

import * as productsApi from "../api/products"
import { useProducts } from "./product"

function TestComponent() {
  const { data } = useProducts()

  return (
    <ul>
      {data.map((product) => (
        <li key={product.id}>{product.name}</li>
      ))}
    </ul>
  )
}

describe("useProducts", () => {
  afterEach(() => {
    vi.restoreAllMocks()
  })

  it("loads products through React Query Suspense", async () => {
    vi.spyOn(productsApi, "getProducts").mockResolvedValue([
      {
        id: 1,
        name: "First product",
        description: "First product description.",
      },
    ])

    const queryClient = new QueryClient({
      defaultOptions: {
        queries: {
          retry: false,
        },
      },
    })

    render(
      <QueryClientProvider client={queryClient}>
        <TestComponent />
      </QueryClientProvider>
    )

    expect(await screen.findByText("First product")).toBeInTheDocument()

    expect(productsApi.getProducts).toHaveBeenCalledTimes(1)
  })
})
