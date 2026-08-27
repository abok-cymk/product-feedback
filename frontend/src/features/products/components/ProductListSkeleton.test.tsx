import { render } from "@testing-library/react";
import { describe, expect, it } from "vitest";

import { ProductListSkeleton } from "./ProductListSkeleton";

describe("ProductListSkeleton", () => {
  it("renders six loading cards", () => {
    const { container } = render(<ProductListSkeleton />);

    expect(container.querySelectorAll('[data-slot="card"]')).toHaveLength(6);
  });
});