import { render, screen } from "@testing-library/react";
import { describe, expect, it } from "vitest";

function TestComponent() {
  return <h1>Product Feedback</h1>;
}

describe("frontend test setup", () => {
  it("renders a React component", () => {
    render(<TestComponent />);

    expect(
      screen.getByRole("heading", {
        name: "Product Feedback",
      }),
    ).toBeInTheDocument();
  });
});