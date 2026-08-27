import { Link, Route, Routes } from "react-router"
import { useProducts } from "./features/products/queries/product"

function HomePage() {
  return (
    <main>
      <h1>Product Feedback</h1>

      <Link to="/products">Products</Link>
    </main>
  )
}

function ProductsPage() {
  const { data: products, isPending, isError } = useProducts()

  if (isPending) {
    return (
      <main>
        <h1>Products</h1>
        <p>Loading products...</p>
      </main>
    )
  }

  if (isError) {
    return (
      <main>
        <h1>Products</h1>
        <p>Unable to load products.</p>
      </main>
    )
  }

  return (
    <main>
      <h1>Products</h1>
      {products.length === 0 ? (
        <p>No products found.</p>
      ) : (
        <ul>
          {products.map((product) => (
            <li key={product.id}>
              <h2>{product.name}</h2>
              <p>{product.description}</p>
            </li>
          ))}
        </ul>
      )}

      <Link to="/">Home</Link>
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
