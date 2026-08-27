import { render, screen } from "@testing-library/react"
import { describe, expect, it } from "vitest"

import { ProductList } from "./ProductList"
import type { Product } from "../schemas/product"

const products: Product[] = [
  {
    id: 1,
    name: "First product",
    description: "First product description.",
  },
  {
    id: 2,
    name: "Second product",
    description: "Second product description.",
  },
  {
    id: 3,
    name: "Third product",
    description: "Third product description.",
  },
]

describe("ProductList", () => {
  it("renders every product", () => {
    render(<ProductList products={products} />)

    expect(
      screen.getByRole("heading", { name: "First product" })
    ).toBeInTheDocument()

    expect(
      screen.getByRole("heading", { name: "Second product" })
    ).toBeInTheDocument()

    expect(
      screen.getByRole("heading", { name: "Third product" })
    ).toBeInTheDocument()
  })
})
