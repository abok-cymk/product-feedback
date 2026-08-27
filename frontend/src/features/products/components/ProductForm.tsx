import { useState } from "react"

import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Textarea } from "@/components/ui/textarea"

export type ProductFormValues = {
  name: string
  description: string
}

type ProductFormProps = {
  onSubmit?: (values: ProductFormValues) => void
}

export function ProductForm({ onSubmit }: ProductFormProps) {
  const [name, setName] = useState("")
  const [description, setDescription] = useState("")

  function handleSubmit(event: React.FormEvent<HTMLFormElement>) {
    event.preventDefault()

    const values = {
      name: name.trim(),
      description: description.trim(),
    }

  if (!values.name || !values.description) {
      return
  }

    onSubmit?.(values)
  }

  return (
    <form onSubmit={handleSubmit} className="space-y-4">
      <div className="space-y-2">
        <label htmlFor="product-name">Name</label>

        <Input
          id="product-name"
          value={name}
          onChange={(event) => setName(event.target.value)}
          placeholder="Product name"
        />
      </div>

      <div className="space-y-2">
        <label htmlFor="product-description">Description</label>

        <Textarea
          id="product-description"
          value={description}
          onChange={(event) => setDescription(event.target.value)}
          placeholder="Product description"
        />
      </div>

      <Button type="submit">
        Create product
      </Button>
    </form>
  )
}