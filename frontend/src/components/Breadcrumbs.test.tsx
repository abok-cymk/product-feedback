import { render, screen } from "@testing-library/react"
import { MemoryRouter } from "react-router"
import { describe, expect, it } from "vitest"
import { Breadcrumbs } from "./Breadcrumbs"

function renderBreadcrumbs(initialPath: string) {
  return render(
    <MemoryRouter initialEntries={[initialPath]}>
      <Breadcrumbs />
    </MemoryRouter>
  )
}

describe("Breadcrumbs Component", () => {
  it("renders absolutely nothing when on the homepage root", () => {
    const { container } = renderBreadcrumbs("/")

    expect(container.firstChild).toBeNull()
  })

  it("renders 'Home > Products' at /products with Products as plain text", () => {
    renderBreadcrumbs("/products")

    const homeLink = screen.getByRole("link", { name: "Home" })
    expect(homeLink).toBeInTheDocument()
    expect(homeLink).toHaveAttribute("href", "/")

    const activeSegment = screen.getByText("Products")
    expect(activeSegment).toBeInTheDocument()
    expect(activeSegment.tagName).toBe("SPAN")
  })

  it("converts intermediate path segments into links when nested deeper", () => {
    renderBreadcrumbs("/products/new-item")

    const productsLink = screen.getByRole("link", { name: "Products" })
    expect(productsLink).toBeInTheDocument()
    expect(productsLink).toHaveAttribute("href", "/products")

    const trailingSegment = screen.getByText("New-item")
    expect(trailingSegment).toBeInTheDocument()
    expect(trailingSegment.tagName).toBe("SPAN")
  })
})
