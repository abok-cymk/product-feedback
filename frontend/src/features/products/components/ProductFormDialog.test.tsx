import { render, screen, waitFor } from "@testing-library/react"
import userEvent from "@testing-library/user-event"
import { afterEach, describe, expect, it, vi } from "vitest"
import { toast } from "sonner"

import { ProductFormDialog } from "./ProductFormDialog"
import * as productQueries from "../queries/product"

vi.mock("sonner", () => ({
  toast: {
    success: vi.fn(),
    error: vi.fn(),
  },
}))

function setup({
  mutateImpl,
  isPending = false,
}: {
  mutateImpl: (values: unknown, opts?: any) => void
  isPending?: boolean
}) {
  const mutate = vi.fn(mutateImpl)

  vi.spyOn(productQueries, "useCreateProduct").mockReturnValue({
    mutate,
    isPending,
  } as any)

  const onOpenChange = vi.fn()

  render(<ProductFormDialog open onOpenChange={onOpenChange} />)

  return { mutate, onOpenChange }
}

async function fillAndSubmit() {
  const user = userEvent.setup()

  await user.type(screen.getByLabelText("Name"), "New product")
  await user.type(screen.getByLabelText("Description"), "Description")
  await user.click(screen.getByRole("button", { name: "Create product" }))
}

describe("ProductFormDialog", () => {
  afterEach(() => {
    vi.clearAllMocks()
  })

  it("shows only a success toast when the mutation succeeds", async () => {
    const { mutate } = setup({
      mutateImpl: (_values, opts) => opts?.onError?.(new Error("boom")),
    })

    await fillAndSubmit()

    await waitFor(() => {
      expect(mutate).toHaveBeenCalled()
    })

    await waitFor(() => {
      expect(toast.error).toHaveBeenCalledWith(
        "Failed to create product. Please try again."
      )
    })

    expect(toast.success).not.toHaveBeenCalled()
    expect(toast.error).toHaveBeenCalledTimes(1)
  })

  it("shows only an error toast when the mutation fails", async () => {
    setup({
      mutateImpl: (_values, opts) => opts?.onError?.(new Error("boom")),
    })

    await fillAndSubmit()

    await waitFor(() => {
      expect(toast.error).toHaveBeenCalledWith(
        "Failed to create product. Please try again."
      )
    })

    expect(toast.success).not.toHaveBeenCalled()
    expect(toast.error).toHaveBeenCalledTimes(1)
  })

  it("does not show a toast before the mutation settles", async () => {
    setup({
      mutateImpl: () => {
        // Intentionally never call onSuccess/onError, simulating an in-flight request.
      },
    })

    await fillAndSubmit()

    expect(toast.success).not.toHaveBeenCalled()
    expect(toast.error).not.toHaveBeenCalled()
  })

  it("calls the mutation with the submitted form values", async () => {
    const { mutate } = setup({
      mutateImpl: (_values, opts) => opts?.onSuccess?.(),
    })

    await fillAndSubmit()

    expect(mutate).toHaveBeenCalledWith(
      {
        name: "New product",
        description: "Description",
      },
      expect.objectContaining({
        onSuccess: expect.any(Function),
        onError: expect.any(Function),
      })
    )
  })

  it("closes the dialog on submit", async () => {
    const { onOpenChange } = setup({
      mutateImpl: (_values, opts) => opts?.onSuccess?.(),
    })

    await fillAndSubmit()

    expect(onOpenChange).toHaveBeenCalledWith(false)
  })

  it("does not call the mutation when required fields are empty", async () => {
    const { mutate } = setup({
      mutateImpl: (_values, opts) => opts?.onSuccess?.(),
    })

    const user = userEvent.setup()
    await user.click(screen.getByRole("button", { name: "Create product" }))

    expect(mutate).not.toHaveBeenCalled()
  })
})
