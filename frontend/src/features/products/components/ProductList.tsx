import type { Product } from "../schemas/product"
import { ProductCard } from "./ProductCard"

type ProductListProps = {
  products: Product[]
}

export function ProductList({ products }: ProductListProps) {
  return (
    <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
      {products.map((product) => (
        <ProductCard key={product.id} product={product} />
      ))}
    </div>
  )
}
