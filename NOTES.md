#

```bash
$ pnpm test src/App.test.tsx
$ vitest run "src/App.test.tsx"

 RUN  v4.1.11 C:/Users/Admin/Desktop/product-feedback/frontend

stderr | src/App.test.tsx > App > renders the error fallback when products fail to load
ApiError: An unexpected API error occurred.
    at apiFetch (C:/Users/Admin/Desktop/product-feedback/frontend/src/lib/api.ts:44:11)
    at getProducts (C:/Users/Admin/Desktop/product-feedback/frontend/src/features/products/api/products.ts:5:20) {
  [stack]: [Getter/Setter],
  [message]: 'An unexpected API error occurred.',
  status: 500,
  name: 'ApiError'
}

The above error occurred in the <ProductsContent> component.

React will try to recreate this component tree from scratch using the error boundary you provided, ErrorBoundary.

Error Boundary caught an error: ApiError: An unexpected API error occurred.
    at apiFetch (C:/Users/Admin/Desktop/product-feedback/frontend/src/lib/api.ts:44:11)
    at getProducts (C:/Users/Admin/Desktop/product-feedback/frontend/src/features/products/api/products.ts:5:20) {
  status: 500
} {
  componentStack: '\n' +
    '    at ProductsContent (C:/Users/Admin/Desktop/product-feedback/frontend/src/App.tsx:44:66)\n' +
    '    at Suspense (<anonymous>)\n' +
    '    at ErrorBoundary (C:/Users/Admin/Desktop/product-feedback/frontend/src/components/ErrorBoundary.tsx:8:1)\n' +
    '    at main (<anonymous>)\n' +
    '    at ProductsPage (<anonymous>)\n' +
    '    at RenderedRoute (file:///C:/Users/Admin/Desktop/product-feedback/frontend/node_modules/.pnpm/react-router@8.3.0_react-do_c27277bcf657dc321048682bd02ab633/node_modules/react-router/dist/development/lib/hooks.js:713:26)\n' +
    '    at Routes (file:///C:/Users/Admin/Desktop/product-feedback/frontend/node_modules/.pnpm/react-router@8.3.0_react-do_c27277bcf657dc321048682bd02ab633/node_modules/react-router/dist/development/lib/components.js:579:19)\n' +
    '    at App (<anonymous>)\n' +
    '    at Router (file:///C:/Users/Admin/Desktop/product-feedback/frontend/node_modules/.pnpm/react-router@8.3.0_react-do_c27277bcf657dc321048682bd02ab633/node_modules/react-router/dist/development/lib/components.js:509:29)\n' +
    '    at MemoryRouter (file:///C:/Users/Admin/Desktop/product-feedback/frontend/node_modules/.pnpm/react-router@8.3.0_react-do_c27277bcf657dc321048682bd02ab633/node_modules/react-router/dist/development/lib/components.js:334:25)\n' +
    '    at QueryClientProvider (file:///C:/Users/Admin/Desktop/product-feedback/frontend/node_modules/.pnpm/@tanstack+react-query@5.102.5_react@19.2.8/node_modules/@tanstack/react-query/build/modern/QueryClientProvider.js:12:32)'
}

 ✓ src/App.test.tsx (4 tests) 823ms
   ✓ App (4)
     ✓ renders the home page 116ms
     ✓ renders the products page  337ms
     ✓ navigates to the products page 30ms
     ✓ renders the error fallback when products fail to load  337ms

 Test Files  1 passed (1)
      Tests  4 passed (4)
   Start at  17:07:13
   Duration  2.87s (transform 159ms, setup 259ms, import 536ms, tests 823ms, environment 1.02s)


Admin@DESKTOP-D9GUONV MINGW64 ~/Desktop/product-feedback/frontend (frontend-2.0)
$
```
