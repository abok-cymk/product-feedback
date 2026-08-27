import React from "react"
import { render, screen } from "@testing-library/react"
import { describe, expect, it, vi, beforeEach, afterEach } from "vitest" // 1. Import vi, beforeEach, afterEach

import { ErrorBoundary } from "./ErrorBoundary"

function BrokenComponent(): React.ReactNode {
  throw new Error("Test error")
  return null
}

describe("ErrorBoundary", () => {
  let consoleSpy: any

  beforeEach(() => {
    consoleSpy = vi.spyOn(console, "error").mockImplementation(() => {})
  })

  afterEach(() => {
    consoleSpy.mockRestore()
  })

  it("renders fallback UI when a child throws", () => {
    render(
      <ErrorBoundary fallback={<p>Something went wrong.</p>}>
        <BrokenComponent />
      </ErrorBoundary>
    )

    expect(screen.getByText("Something went wrong.")).toBeInTheDocument()
  })
})
