import { describe, expect, it } from "vitest"

import {
  productSchema,
  productResponseSchema,
  productsResponseSchema,
} from "./product"

const validProduct = {
  id: 1,
  name: "First product",
  description: "First product description.",
}

describe("productSchema", () => {
  it("accepts a valid product", () => {
    expect(productSchema.parse(validProduct)).toEqual(validProduct)
  })

  it("rejects a product with a non-numeric id", () => {
    expect(() =>
      productSchema.parse({ ...validProduct, id: "not-a-number" })
    ).toThrow()
  })

  it("rejects a product missing a name", () => {
    const { name: _name, ...rest } = validProduct
    expect(() => productSchema.parse(rest)).toThrow()
  })
})

describe("productResponseSchema", () => {
  it("accepts a single wrapped product", () => {
    const response = { data: validProduct }
    expect(productResponseSchema.parse(response)).toEqual(response)
  })

  it("rejects an unwrapped product (no data key)", () => {
    expect(() => productResponseSchema.parse(validProduct)).toThrow()
  })

  it("rejects a wrapped array instead of a single product", () => {
    expect(() =>
      productResponseSchema.parse({ data: [validProduct] })
    ).toThrow()
  })
})

describe("productsResponseSchema", () => {
  it("accepts a wrapped array of products", () => {
    const response = { data: [validProduct] }
    expect(productsResponseSchema.parse(response)).toEqual(response)
  })

  it("accepts an empty wrapped array", () => {
    expect(productsResponseSchema.parse({ data: [] })).toEqual({ data: [] })
  })

  it("rejects a wrapped single product instead of an array", () => {
    expect(() => productsResponseSchema.parse({ data: validProduct })).toThrow()
  })
})
