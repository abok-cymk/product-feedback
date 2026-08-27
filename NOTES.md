#

```bash
Admin@DESKTOP-D9GUONV MINGW64 ~/Desktop/product-feedback/frontend (frontend-3.0)
$ pnpm test src/App.test.tsx
$ vitest run "src/App.test.tsx"

 RUN  v4.1.11 C:/Users/Admin/Desktop/product-feedback/frontend

 ❯ src/App.test.tsx (4 tests | 1 failed) 1541ms
   ❯ App (4)
     ✓ renders the home page 139ms
     ✓ renders the products page  355ms
     ✓ navigates to the products page 28ms
     × renders the error fallback when products fail to load 1017ms

⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯ Failed Tests 1 ⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯

 FAIL  src/App.test.tsx > App > renders the error fallback when products fail to load
TestingLibraryElementError: Unable to find an element with the text: Unable to load products.. This could be because the text is broken up by multiple elements. In this case, you can provide a function for your text matcher to make your matcher more flexible.

Ignored nodes: comments, script, style
<body>
  <div>
    <main
      class="mx-auto max-w-6xl px-6 py-10 sm:px-3 sm:py-5 md:px-4 md:py-4 lg:px-0 lg:py-3"
    >
      <h1>
        Products
      </h1>
      <nav
        aria-label="breadcrumb"
        class="mb-4 flex items-center gap-2 text-base text-muted-foreground"
      >
        <a
          class="transition-colors hover:text-foreground hover:underline"
          data-discover="true"
          href="/"
        >
          Home
        </a>
        <div
          class="flex items-center gap-2"
        >
          <span
            class="font-light text-foreground/40"
          >
            <svg
              class="tabler-icon tabler-icon-chevron-right size-4"
              fill="none"
              height="24"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1"
              viewBox="0 0 24 24"
              width="24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M9 6l6 6l-6 6"
              />
            </svg>
          </span>
          <span
            aria-current="page"
            class="font-medium text-foreground"
          >
            Products
          </span>
        </div>
      </nav>
      <div
        class="group/alert relative grid w-full gap-0.5 rounded-lg border px-2.5 py-2 text-left text-sm has-data-[slot=alert-action]:relative has-data-[slot=alert-action]:pr-18 has-[>svg]:grid-cols-[auto_1fr] has-[>svg]:gap-x-2 *:[svg]:row-span-2 *:[svg]:translate-y-0.5 *:[svg:not([class*='size-'])]:size-4 bg-card text-destructive *:data-[slot=alert-description]:text-destructive/90 *:[svg]:text-current"
        data-slot="alert"
        role="alert"
      >
        <div
          class="font-medium group-has-[>svg]/alert:col-start-2 [&_a]:underline [&_a]:underline-offset-3 [&_a]:hover:text-foreground"
          data-slot="alert-title"
        >
          Unable to load products
        </div>
        <div
          class="text-sm text-balance text-muted-foreground md:text-pretty [&_a]:underline [&_a]:underline-offset-3 [&_a]:hover:text-foreground [&_p:not(:last-child)]:mb-4"
          data-slot="alert-description"
        >
          We couldn't retrieve the products. Please try again later.
        </div>
      </div>
    </main>
  </div>
</body>

Ignored nodes: comments, script, style
<body>
  <div>
    <main
      class="mx-auto max-w-6xl px-6 py-10 sm:px-3 sm:py-5 md:px-4 md:py-4 lg:px-0 lg:py-3"
    >
      <h1>
        Products
      </h1>
      <nav
        aria-label="breadcrumb"
        class="mb-4 flex items-center gap-2 text-base text-muted-foreground"
      >
        <a
          class="transition-colors hover:text-foreground hover:underline"
          data-discover="true"
          href="/"
        >
          Home
        </a>
        <div
          class="flex items-center gap-2"
        >
          <span
            class="font-light text-foreground/40"
          >
            <svg
              class="tabler-icon tabler-icon-chevron-right size-4"
              fill="none"
              height="24"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1"
              viewBox="0 0 24 24"
              width="24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M9 6l6 6l-6 6"
              />
            </svg>
          </span>
          <span
            aria-current="page"
            class="font-medium text-foreground"
          >
            Products
          </span>
        </div>
      </nav>
      <div
        class="group/alert relative grid w-full gap-0.5 rounded-lg border px-2.5 py-2 text-left text-sm has-data-[slot=alert-action]:relative has-data-[slot=alert-action]:pr-18 has-[>svg]:grid-cols-[auto_1fr] has-[>svg]:gap-x-2 *:[svg]:row-span-2 *:[svg]:translate-y-0.5 *:[svg:not([class*='size-'])]:size-4 bg-card text-destructive *:data-[slot=alert-description]:text-destructive/90 *:[svg]:text-current"
        data-slot="alert"
        role="alert"
      >
        <div
          class="font-medium group-has-[>svg]/alert:col-start-2 [&_a]:underline [&_a]:underline-offset-3 [&_a]:hover:text-foreground"
          data-slot="alert-title"
        >
          Unable to load products
        </div>
        <div
          class="text-sm text-balance text-muted-foreground md:text-pretty [&_a]:underline [&_a]:underline-offset-3 [&_a]:hover:text-foreground [&_p:not(:last-child)]:mb-4"
          data-slot="alert-description"
        >
          We couldn't retrieve the products. Please try again later.
        </div>
      </div>
    </main>
  </div>
</body>
 ❯ waitForWrapper node_modules/.pnpm/@testing-library+dom@10.4.1/node_modules/@testing-library/dom/dist/wait-for.js:163:27
 ❯ node_modules/.pnpm/@testing-library+dom@10.4.1/node_modules/@testing-library/dom/dist/query-helpers.js:86:33
 ❯ src/App.test.tsx:111:22
    109|
    110|       expect(
    111|         await screen.findByText("Unable to load products.")
       |                      ^
    112|       ).toBeInTheDocument()
    113|     } finally {

⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯[1/1]⎯


 Test Files  1 failed (1)
      Tests  1 failed | 3 passed (4)
   Start at  17:30:40
   Duration  3.80s (transform 171ms, setup 283ms, import 566ms, tests 1.54s, environment 1.11s)

[ELIFECYCLE] Test failed. See above for more details.

Admin@DESKTOP-D9GUONV MINGW64 ~/Desktop/product-feedback/frontend (frontend-3.0)
$

```

```ts
import { QueryClient, QueryClientProvider } from "@tanstack/react-query"
import { fireEvent, render, screen, waitFor } from "@testing-library/react"
import { MemoryRouter } from "react-router"
import { describe, expect, it, beforeEach, vi } from "vitest"

import App from "./App"

const mockProducts = {
  data: [
    {
      id: 1,
      name: "First product",
      description: "First product description.",
    },
  ],
}

function renderApp(initialEntry: string) {
  const queryClient = new QueryClient({
    defaultOptions: {
      queries: {
        retry: false,
      },
    },
  })

  return render(
    <QueryClientProvider client={queryClient}>
      <MemoryRouter initialEntries={[initialEntry]}>
        <App />
      </MemoryRouter>
    </QueryClientProvider>
  )
}

describe("App", () => {
  beforeEach(() => {
    globalThis.fetch = vi.fn().mockImplementation(() =>
      Promise.resolve({
        ok: true,
        status: 200,
        json: () => Promise.resolve(mockProducts),
      })
    ) as any
  })

  it("renders the home page", () => {
    renderApp("/")

    expect(
      screen.getByRole("heading", {
        name: "Product Feedback",
      })
    ).toBeInTheDocument()
  })

  it("renders the products page", async () => {
    renderApp("/products")

    expect(
      screen.getByRole("heading", {
        name: "Products",
      })
    ).toBeInTheDocument()

    await waitFor(() => {
      expect(
        screen.getByRole("heading", {
          name: "First product",
        })
      ).toBeInTheDocument()
    })
  })

  it("navigates to the products page", async () => {
    renderApp("/")

    fireEvent.click(
      screen.getByRole("button", {
        name: "Products",
      })
    )

    await waitFor(() => {
      expect(
        screen.getByRole("heading", {
          name: "Products",
        })
      ).toBeInTheDocument()
    })
  })

  it("renders the error fallback when products fail to load", async () => {
    const consoleSpy = vi.spyOn(console, "error").mockImplementation(() => {})

    try {
      globalThis.fetch = vi.fn().mockImplementation(() =>
        Promise.resolve({
          ok: false,
          status: 500,
          json: () =>
            Promise.resolve({
              error: "Internal Server Error",
            }),
        })
      ) as any

      renderApp("/products")

      expect(
        await screen.findByText("Unable to load products")
      ).toBeInTheDocument()
    } finally {
      consoleSpy.mockRestore()
    }
  })
})

```
