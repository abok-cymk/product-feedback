import { QueryClient, QueryClientProvider } from "@tanstack/react-query"
import { render, screen, waitFor } from "@testing-library/react"
import { afterEach, describe, expect, it, vi } from "vitest"

import * as productsApi from "../api/products"
import { productKeys, useCreateProduct, useProducts } from "./product"

function createTestQueryClient() {
  return new QueryClient({
    defaultOptions: {
      queries: {
        retry: false,
      },
    },
  })
}

function renderWithProvider(ui: React.ReactElement, queryClient: QueryClient) {
  return render(
    <QueryClientProvider client={queryClient}>
      {ui}
    </QueryClientProvider>
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

    function ListTestComponent() {
      const { data } = useProducts()
      return (
        <ul>
          {data.map((product) => (
            <li key={product.id}>{product.name}</li>
          ))}
        </ul>
      )
    }

    const queryClient = createTestQueryClient()
    renderWithProvider(<ListTestComponent />, queryClient)

    expect(await screen.findByText("First product")).toBeInTheDocument()
    expect(productsApi.getProducts).toHaveBeenCalledTimes(1)
  })

  it("creates a product and invalidates the products list", async () => {
    const queryClient = createTestQueryClient()
    const invalidateQueriesSpy = vi.spyOn(queryClient, "invalidateQueries")
    
    const createdProduct = {
      id: 3,
      name: "New product",
      description: "New product description.",
    }

    vi.spyOn(productsApi, "createProduct").mockResolvedValue(createdProduct)

    function MutationTestComponent() {
      const mutation = useCreateProduct()
      return (
        <button
          onClick={() =>
            mutation.mutate({
              name: "New product",
              description: "New product description.",
            })
          }
        >
          Create product
        </button>
      )
    }

    renderWithProvider(<MutationTestComponent />, queryClient)

    screen.getByRole("button", { name: "Create product" }).click()

    await waitFor(() => {
      expect(productsApi.createProduct).toHaveBeenCalledWith({
        name: "New product",
        description: "New product description.",
      })
    })

    await waitFor(() => {
      expect(invalidateQueriesSpy).toHaveBeenCalledWith({
        queryKey: productKeys.lists(),
      })
    })
  })
})

describe("useCreateProduct (integration with real createProduct)", () => {
  afterEach(() => {
    vi.restoreAllMocks()
  })

  it("resolves with the created product from a wrapped API response", async () => {
    vi.spyOn(globalThis, "fetch").mockResolvedValue(
      new Response(
        JSON.stringify({
          data: {
            id: 4,
            name: "Integration product",
            description: "Created via real fetch mock.",
          },
        }),
        {
          status: 201,
          headers: { "Content-Type": "application/json" },
        }
      )
    )

    const queryClient = createTestQueryClient()

    function MutationTestComponent() {
      const mutation = useCreateProduct()
      return (
        <div>
          <button
            onClick={() =>
              mutation.mutate({
                name: "Integration product",
                description: "Created via real fetch mock.",
              })
            }
          >
            Create product
          </button>
          {mutation.isSuccess && <p>Created!</p>}
        </div>
      )
    }

    renderWithProvider(<MutationTestComponent />, queryClient)

    screen.getByRole("button", { name: "Create product" }).click()

    expect(await screen.findByText("Created!")).toBeInTheDocument()
  })
})
