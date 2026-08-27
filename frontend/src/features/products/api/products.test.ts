import { afterEach, describe, expect, it, vi } from "vitest";

import { getProducts } from "./products";

describe("getProducts", () => {
  afterEach(() => {
    vi.restoreAllMocks();
  });

  it("returns validated products from the API", async () => {
    vi.spyOn(globalThis, "fetch").mockResolvedValue(
      new Response(
        JSON.stringify({
          data: [
            {
              id: 1,
              name: "First product",
              description: "First product description.",
            },
          ],
        }),
        {
          status: 200,
          headers: {
            "Content-Type": "application/json",
          },
        },
      ),
    );

    await expect(getProducts()).resolves.toEqual([
      {
        id: 1,
        name: "First product",
        description: "First product description.",
      },
    ]);

    expect(fetch).toHaveBeenCalledWith(
      "/api/products",
      expect.objectContaining({
        headers: expect.objectContaining({
          Accept: "application/json",
          "Content-Type": "application/json",
        }),
      }),
    );
  });

  it("rejects an invalid API response", async () => {
    vi.spyOn(globalThis, "fetch").mockResolvedValue(
      new Response(
        JSON.stringify({
          data: [
            {
              id: "not-a-number",
              name: "Broken product",
              description: "Invalid response",
            },
          ],
        }),
        {
          status: 200,
          headers: {
            "Content-Type": "application/json",
          },
        },
      ),
    );

    await expect(getProducts()).rejects.toThrow();
  });
});