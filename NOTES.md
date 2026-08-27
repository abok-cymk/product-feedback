#

```bash
Admin@DESKTOP-D9GUONV MINGW64 ~/Desktop/product-feedback/frontend (frontend-2.0)
$ pnpm test src/App.test.tsx
$ vitest run "src/App.test.tsx"

 RUN  v4.1.11 C:/Users/Admin/Desktop/product-feedback/frontend

stderr | src/App.test.tsx > App > renders the products page
An error occurred in the <ProductsContent> component.

Consider adding an error boundary to your tree to customize error handling behavior.
Visit https://react.dev/link/error-boundaries to learn more about error boundaries.


 ❯ src/App.test.tsx (2 tests | 1 failed) 1164ms
   ❯ App (2)
     ✓ renders the home page 128ms
     × renders the products page 1033ms

⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯ Failed Tests 1 ⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯

 FAIL  src/App.test.tsx > App > renders the products page
TestingLibraryElementError: Unable to find role="heading" and name "First product"

Ignored nodes: comments, script, style
<body>
  <div />
</body>

Ignored nodes: comments, script, style
<html>
  <head />
  <body>
    <div />
  </body>
</html>
 ❯ waitForWrapper node_modules/.pnpm/@testing-library+dom@10.4.1/node_modules/@testing-library/dom/dist/wait-for.js:163:27
 ❯ src/App.test.tsx:46:11
     44|     ).toBeInTheDocument()
     45|
     46|     await waitFor(() => {
       |           ^
     47|       expect(
     48|         screen.getByRole("heading", {

⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯[1/1]⎯

⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯ Unhandled Errors ⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯

Vitest caught 1 unhandled error during the test run.
This might cause false positive tests. Resolve unhandled errors to make sure your tests are not affected.

⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯ Uncaught Exception ⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯
TypeError: Failed to parse URL from /api/products
This error originated in "src/App.test.tsx" test file. It doesn't mean the error was thrown inside the file itself, but while it was running.
The latest test that might've caused the error is "renders the products page". It might mean one of the following:
- The error was thrown, while Vitest was running this test.
- If the error occurred after the test had been completed, this was the last documented test before it was thrown.
Caused by: TypeError: Invalid URL
 ❯ new URL node:internal/url:819:25
 ❯ new URL node_modules/.pnpm/vitest@4.1.11_@types+node@2_1afdca3b5bcfa3e4a0cd59e9639ccb33/node_modules/vitest/dist/chunks/index.DC7d2Pf8.js:557:2
 ❯ new Request node:internal/deps/undici/undici:11832:25
 ❯ fetch node:internal/deps/undici/undici:12757:25
 ❯ fetch node:internal/deps/undici/undici:17407:10
 ❯ fetch node:internal/bootstrap/web/exposed-window-or-worker:83:12
 ❯ apiFetch src/lib/api.ts:15:26
 ❯ getProducts src/features/products/api/products.ts:5:26
 ❯ Object.fetchFn [as fn] node_modules/.pnpm/@tanstack+query-core@5.102.5/node_modules/@tanstack/query-core/build/modern/query.js:196:11
 ❯ run node_modules/.pnpm/@tanstack+query-core@5.102.5/node_modules/@tanstack/query-core/build/modern/retryer.js:83:46

⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯
Serialized Error: { code: 'ERR_INVALID_URL', input: '/api/products' }
⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯


 Test Files  1 failed (1)
      Tests  1 failed | 1 passed (2)
     Errors  1 error
   Start at  15:35:58
   Duration  3.79s (transform 158ms, setup 371ms, import 433ms, tests 1.16s, environment 1.50s)

[ELIFECYCLE] Test failed. See above for more details.

Admin@DESKTOP-D9GUONV MINGW64 ~/Desktop/product-feedback/frontend (frontend-2.0)
$

```

```ts
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
} from "@/components/ui/card";
import type { Product } from "../product";

type ProductCardProps = {
  product: Product;
};

export function ProductCard({ product }: ProductCardProps) {
  return (
    <Card>
      <CardHeader>
        <h2>{product.name}</h2>
        <CardDescription>Product #{product.id}</CardDescription>
      </CardHeader>

      <CardContent>
        <p className="text-sm text-muted-foreground">
          {product.description}
        </p>
      </CardContent>
    </Card>
  );
}
```
