import { Link, Route, Routes } from "react-router"
import { ProductList } from "./features/products/components/ProductList"
import { ProductListSkeleton } from "./features/products/components/ProductListSkeleton"
import { useProducts } from "./features/products/queries/product"
import { Suspense } from "react"

function HomePage() {
  return (
    <main>
      <h1>Product Feedback</h1>

      <Link to="/products">Products</Link>
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
  return (
    <main className="max-w-6xl mx-auto px-6 sm:px-3 md:px-4 lg:px-0 py-10 sm:py-5 md:py-4 lg:py-3">
      <h1>Products</h1>

      <Suspense fallback={<ProductListSkeleton />}>
        <ProductsContent />
      </Suspense>

      <Link to="/">Home</Link>
    </main>
  )
}

export function App() {
  return (
    <Routes>
      <Route path="/" element={<HomePage />} />
      <Route path="/products" element={<ProductsPage />} />
    </Routes>
  )
}

export default App
