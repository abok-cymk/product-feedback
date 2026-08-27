import { render, screen } from "@testing-library/react"
import { describe, expect, it } from "vitest"

import { ProductError } from "./ProductError"

describe("ProductError", () => {
  it("renders the product loading error message", () => {
    render(<ProductError />)

    expect(
      screen.getByRole("alert"),
    ).toBeInTheDocument()

    expect(
      screen.getByText("Unable to load products."),
    ).toBeInTheDocument()

    expect(
      screen.getByText(
        "We couldn't retrieve the products. Please try again later.",
      ),
    ).toBeInTheDocument()
  })
})