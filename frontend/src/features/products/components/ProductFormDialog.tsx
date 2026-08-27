import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog"
import { ProductForm } from "./ProductForm"
import { useCreateProduct } from "../queries/product"
import { toast } from "sonner"
import { Button } from "@/components/ui/button"

export interface ProductFormDialogProps {
  open: boolean
  onOpenChange: (open: boolean) => void
}

export function ProductFormDialog({
  open,
  onOpenChange,
}: ProductFormDialogProps) {
  const { mutate } = useCreateProduct()

 const handleFormSubmit = (values: { name: string; description: string }) => {
    mutate(values, {
      onError: () => {
        toast.error("Failed to create product. Please Try again")
      }
    })

    toast.success("Product added!")
    onOpenChange(false)
  }  
  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogTrigger asChild>
        <Button
          type="button"
          className="cursor-pointer rounded-md px-4 py-2 text-sm font-medium mb-2"
        >
          + Add Feedback
        </Button>
      </DialogTrigger>

      <DialogContent>
        <DialogHeader>
          <DialogTitle>Create Product</DialogTitle>
          <DialogDescription>
            Add a product that you would like users to give feedback on.
          </DialogDescription>
        </DialogHeader>

        <ProductForm onSubmit={handleFormSubmit} />
      </DialogContent>
    </Dialog>
  )
}
