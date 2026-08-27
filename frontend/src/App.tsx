import { Route, Routes } from "react-router"
import { ProductList } from "./features/products/components/ProductList"
import { ProductListSkeleton } from "./features/products/components/ProductListSkeleton"
import { useProducts } from "./features/products/queries/product"
import { Suspense, useState } from "react"
import { useAppNavigation } from "./lib/navigation"
import { Breadcrumbs } from "./components/Breadcrumbs"
import { ErrorBoundary } from "./components/ErrorBoundary"
import { ProductError } from "./features/products/components/ProductError"
import { ProductFormDialog } from "./features/products/components/ProductFormDialog"
import { Toaster } from "sonner"
import { Button } from "./components/ui/button"

function HomePage() {
  const { navigateTo, isPending } = useAppNavigation()
  return (
    <main>
      <h1>Product Feedback</h1>

      <Button
        variant="link"
        onClick={() => navigateTo("/products")}
        className="cursor-pointer"
      >
        {isPending ? "Loading products..." : "Products"}
      </Button>
    </main>
  )
}

function ProductsContent() {
  const { data: products } = useProducts()

  if (products.length === 0) {
    return <p>No products found.</p>
  }

  return <ProductList products={products} />
}

function ProductsPage() {
  const [isCreateDialogOpen, setIsCreateDialogOpen] = useState(false)

  return (
    <main className="mx-auto max-w-6xl px-6 py-10 sm:px-3 sm:py-5 md:px-4 md:py-4 lg:px-0 lg:py-3">
      <h1>Products</h1>
      <Breadcrumbs />
      <ProductFormDialog
        open={isCreateDialogOpen}
        onOpenChange={setIsCreateDialogOpen}
      />
      <ErrorBoundary fallback={<ProductError />}>
        <Suspense fallback={<ProductListSkeleton />}>
          <ProductsContent />
        </Suspense>
      </ErrorBoundary>
    </main>
  )
}

export function App() {
  return (
    <>
      <Toaster richColors position="top-right" />
      <Routes>
        <Route path="/" element={<HomePage />} />
        <Route path="/products" element={<ProductsPage />} />
      </Routes>
    </>
  )
}

export default App
