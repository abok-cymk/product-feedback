#

```bash

Admin@DESKTOP-D9GUONV MINGW64 ~/Desktop/product-feedback/frontend (feature-hook-form)
$ pnpm test
$ vitest run

 RUN  v4.1.11 C:/Users/Admin/Desktop/product-feedback/frontend

 ✓ src/test/smoke.test.tsx (1 test) 237ms
 ✓ src/features/products/components/ProductCard.test.tsx (1 test) 304ms
 ✓ src/features/products/components/ProductList.test.tsx (1 test) 314ms
     ✓ renders every product  310ms
 ✓ src/features/products/queries/products.test.tsx (3 tests) 486ms
     ✓ creates a product and invalidates the products list  349ms
 ✓ src/features/products/components/ProductListSkeleton.test.tsx (1 test) 82ms
 ✓ src/features/products/components/ProductError.test.tsx (1 test) 256ms
 ✓ src/components/ErrorBoundary.test.tsx (1 test) 89ms
 ✓ src/components/Breadcrumbs.test.tsx (3 tests) 449ms
     ✓ renders 'Home > Products' at /products with Products as plain text  344ms
 ✓ src/App.test.tsx (4 tests) 1099ms
     ✓ renders the products page  396ms
     ✓ renders the error fallback when products fail to load  352ms
 ✓ src/features/products/components/ProductForm.test.tsx (2 tests) 1123ms
     ✓ submits the entered product values  1060ms
 ❯ src/features/products/api/products.test.ts (3 tests | 1 failed) 24ms
     ✓ returns validated products from the API 13ms
     ✓ rejects an invalid API response 3ms
     × creates a product through the API 6ms
 ✓ src/features/products/schemas/product.test.ts (9 tests) 10ms
 ❯ src/features/products/components/ProductFormDialog.test.tsx (6 tests | 2 failed) 3029ms
     ✓ shows only a success toast when the mutation succeeds  947ms
     × shows only an error toast when the mutation fails 532ms
     × does not show a toast before the mutation settles 494ms
     ✓ calls the mutation with the submitted form values  506ms
     ✓ closes the dialog on submit  481ms
     ✓ does not call the mutation when required fields are empty 62ms

⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯ Failed Tests 3 ⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯

 FAIL  src/features/products/components/ProductFormDialog.test.tsx > ProductFormDialog > shows only an error toast when the mutation fails
AssertionError: expected "vi.fn()" to not be called at all, but actually been called 1 times

Received:

  1st vi.fn() call:

    Array [
      "Product added!",
    ]


Number of calls: 1

 ❯ src/features/products/components/ProductFormDialog.test.tsx:78:31
     76|     })
     77|
     78|     expect(toast.success).not.toHaveBeenCalled()
       |                               ^
     79|     expect(toast.error).toHaveBeenCalledTimes(1)
     80|   })

⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯[1/3]⎯

 FAIL  src/features/products/components/ProductFormDialog.test.tsx > ProductFormDialog > does not show a toast before the mutation settles
AssertionError: expected "vi.fn()" to not be called at all, but actually been called 1 times

Received:

  1st vi.fn() call:

    Array [
      "Product added!",
    ]


Number of calls: 1

 ❯ src/features/products/components/ProductFormDialog.test.tsx:91:31
     89|     await fillAndSubmit()
     90|
     91|     expect(toast.success).not.toHaveBeenCalled()
       |                               ^
     92|     expect(toast.error).not.toHaveBeenCalled()
     93|   })

⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯[2/3]⎯

 FAIL  src/features/products/api/products.test.ts > getProducts > creates a product through the API
AssertionError: promise rejected "ZodError: [
  {
    "expected": "object",… { …(8) }" instead of resolving
 ❯ src/features/products/api/products.test.ts:96:6
     94|         description: "New product description.",
     95|       })
     96|     ).resolves.toEqual({
       |      ^
     97|       id: 2,
     98|       name: "New product",

Caused by: ZodError: [
  {
    "expected": "object",
    "code": "invalid_type",
    "path": [
      "data"
    ],
    "message": "Invalid input: expected object, received undefined"
  }
]
 ❯ src/features/products/api/products.ts:22:37
 ❯ apiFetch src/lib/api.ts:47:18
 ❯ createProduct src/features/products/api/products.ts:16:20
 ❯ src/features/products/api/products.test.ts:91:5

⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯
Serialized Error: { _zod: { def: [ { expected: 'object', code: 'invalid_type', path: [ 'data' ], message: 'Invalid input: expected object, received undefined' } ], constr: 'Function<ZodError>', traits: { constructor: 'Function<Set>', has: 'Function<has>', add: 'Function<add>', delete: 'Function<delete>', difference: 'Function<difference>', clear: 'Function<clear>', entries: 'Function<entries>', forEach: 'Function<forEach>', intersection: 'Function<intersection>', isSubsetOf: 'Function<isSubsetOf>', isSupersetOf: 'Function<isSupersetOf>', isDisjointFrom: 'Function<isDisjointFrom>', size: 2, symmetricDifference: 'Function<symmetricDifference>', union: 'Function<union>', values: 'Function<values>', keys: 'Function<values>' }, deferred: [] }, issues: [ { expected: 'object', code: 'invalid_type', path: [ 'data' ], message: 'Invalid input: expected object, received undefined' } ], format: 'Function<value>', flatten: 'Function<value>', addIssue: 'Function<value>', addIssues: 'Function<value>', isEmpty: false }
⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯[3/3]⎯


 Test Files  2 failed | 11 passed (13)
      Tests  3 failed | 33 passed (36)
   Start at  22:17:26
   Duration  12.56s (transform 1.16s, setup 7.47s, import 18.51s, tests 7.50s, environment 31.17s)

[ELIFECYCLE] Test failed. See above for more details.

Admin@DESKTOP-D9GUONV MINGW64 ~/Desktop/product-feedback/frontend (feature-hook-form)
$

```
