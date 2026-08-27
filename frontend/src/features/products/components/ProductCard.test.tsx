import { render, screen } from "@testing-library/react"
import { describe, expect, it } from "vitest"

import { ProductCard } from "./ProductCard"

describe("ProductCard", () => {
  it("renders the product information", () => {
    render(
      <ProductCard
        product={{
          id: 1,
          name: "First product",
          description: "First product description.",
        }}
      />
    )

    expect(
      screen.getByRole("heading", {
        name: "First product",
      })
    ).toBeInTheDocument()

    expect(screen.getByText("Product #1")).toBeInTheDocument()

    expect(screen.getByText("First product description.")).toBeInTheDocument()
  })
})
