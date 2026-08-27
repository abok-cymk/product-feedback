import { apiFetch } from "../../../lib/api"
import {
  productSchema,
  productsResponseSchema,
  type Product,
} from "../schemas/product.ts"

export type CreateProductInput = {
  name: string
  description: string
}

export async function createProduct(
  input: CreateProductInput
): Promise<Product> {
  return apiFetch(
    "/api/products",
    {
      method: "POST",
      body: JSON.stringify(input),
    },
    (body) => productSchema.parse(body)
  )
}

export async function getProducts(): Promise<Product[]> {
  const response = await apiFetch("/api/products", undefined, (body) =>
    productsResponseSchema.parse(body)
  )

  return response.data
}
