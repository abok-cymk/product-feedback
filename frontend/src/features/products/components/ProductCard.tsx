import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
} from "@/components/ui/card"
import type { Product } from "../schemas/product"

type ProductCardProps = {
  product: Product
}

export function ProductCard({ product }: ProductCardProps) {
  return (
    <Card>
      <CardHeader>
        <h2>{product.name}</h2>
        <CardDescription>Product #{product.id}</CardDescription>
      </CardHeader>

      <CardContent>
        <p className="text-sm text-muted-foreground">{product.description}</p>
      </CardContent>
    </Card>
  )
}
