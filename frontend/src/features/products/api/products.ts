import { apiFetch } from "../../../lib/api";
import { productsResponseSchema, type Product } from "../product.ts";

export async function getProducts(): Promise<Product[]> {
  const response = await apiFetch(
    "/api/products",
    undefined,
    (body) => productsResponseSchema.parse(body),
  );

  return response.data;
}