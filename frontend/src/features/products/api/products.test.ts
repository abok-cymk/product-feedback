import { afterEach, describe, expect, it, vi } from "vitest"

import { createProduct, getProducts } from "./products"

describe("getProducts", () => {
  afterEach(() => {
    vi.restoreAllMocks()
  })

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
        }
      )
    )

    await expect(getProducts()).resolves.toEqual([
      {
        id: 1,
        name: "First product",
        description: "First product description.",
      },
    ])

    expect(fetch).toHaveBeenCalledWith(
      "/api/products",
      expect.objectContaining({
        headers: expect.objectContaining({
          Accept: "application/json",
          "Content-Type": "application/json",
        }),
      })
    )
  })

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
        }
      )
    )

    await expect(getProducts()).rejects.toThrow()
  })

  it("creates a product through the API", async () => {
    vi.spyOn(globalThis, "fetch").mockResolvedValue(
      new Response(
        JSON.stringify({
          data: {
            id: 2,
            name: "New product",
            description: "New product description.",
          },
        }),
        {
          status: 201,
          headers: {
            "Content-Type": "application/json",
          },
        }
      )
    )

    await expect(
      createProduct({
        name: "New product",
        description: "New product description.",
      })
    ).resolves.toEqual({
      id: 2,
      name: "New product",
      description: "New product description.",
    })

    expect(fetch).toHaveBeenCalledWith(
      "/api/products",
      expect.objectContaining({
        method: "POST",
        body: JSON.stringify({
          name: "New product",
          description: "New product description.",
        }),
        headers: expect.objectContaining({
          Accept: "application/json",
          "Content-Type": "application/json",
        }),
      })
    )
  })
})
