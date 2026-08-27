import { render, screen } from "@testing-library/react"
import userEvent from "@testing-library/user-event"
import { describe, expect, it, vi } from "vitest"

import { ProductForm } from "./ProductForm"

describe("ProductForm", () => {
  it("submits the entered product values", async () => {
    const user = userEvent.setup()
    const onSubmit = vi.fn()

    render(<ProductForm onSubmit={onSubmit} />)

    await user.type(
      screen.getByLabelText("Name"),
      "New product",
    )

    await user.type(
      screen.getByLabelText("Description"),
      "New product description.",
    )

    await user.click(
      screen.getByRole("button", {
        name: "Create product",
      }),
    )

    expect(onSubmit).toHaveBeenCalledWith({
      name: "New product",
      description: "New product description.",
    })
  })

  it("does not submit when required fields are empty", async () => {
    const user = userEvent.setup()
    const onSubmit = vi.fn()

    render(<ProductForm onSubmit={onSubmit} />)

    await user.click(
      screen.getByRole("button", {
        name: "Create product",
      }),
    )

    expect(onSubmit).not.toHaveBeenCalled()
  })
})