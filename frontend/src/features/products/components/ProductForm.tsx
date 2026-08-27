import { useForm } from "react-hook-form"
import { zodResolver } from "@hookform/resolvers/zod"
import { z } from "zod"

import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Textarea } from "@/components/ui/textarea"

const productFormSchema = z.object({
  name: z.string().trim().min(1, "Name is required"),
  description: z.string().trim().min(1, "Description is required"),
})

export type ProductFormValues = z.infer<typeof productFormSchema>

type ProductFormProps = {
  onSubmit?: (values: ProductFormValues) => void
  isSubmitting?: boolean
}

export function ProductForm({ onSubmit, isSubmitting }: ProductFormProps) {
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<ProductFormValues>({
    resolver: zodResolver(productFormSchema),
    defaultValues: {
      name: "",
      description: "",
    },
  })

  function handleValidSubmit(values: ProductFormValues) {
    onSubmit?.(values)
  }

  return (
    <form onSubmit={handleSubmit(handleValidSubmit)} className="space-y-4">
      <div className="space-y-2">
        <label htmlFor="product-name">Name</label>

        <Input
          id="product-name"
          placeholder="Product name"
          aria-invalid={errors.name ? "true" : "false"}
          {...register("name")}
        />

        {errors.name && (
          <p className="text-xs text-destructive">{errors.name.message}</p>
        )}
      </div>

      <div className="space-y-2">
        <label htmlFor="product-description">Description</label>

        <Textarea
          id="product-description"
          placeholder="Product description"
          aria-invalid={errors.description ? "true" : "false"}
          {...register("description")}
        />

        {errors.description && (
          <p className="text-xs text-destructive">
            {errors.description.message}
          </p>
        )}
      </div>

      <Button type="submit" disabled={isSubmitting}>
        {isSubmitting ? "Creating…" : "Create product"}
      </Button>
    </form>
  )
}
