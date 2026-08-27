import {
  useMutation,
  useQueryClient,
  useSuspenseQuery,
} from "@tanstack/react-query"

import {
  createProduct,
  getProducts,
  type CreateProductInput,
} from "../api/products"
import type { Product } from "../schemas/product"

export const productKeys = {
  all: ["products"] as const,
  lists: () => [...productKeys.all, "list"] as const,
}

export function useProducts() {
  return useSuspenseQuery({
    queryKey: productKeys.lists(),
    queryFn: getProducts,
  })
}

export function useCreateProduct() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: (input: CreateProductInput) => createProduct(input),

    onMutate: async (newProductInput) => {
      const queryKey = productKeys.lists()

      await queryClient.cancelQueries({ queryKey })

      const previousProducts = queryClient.getQueryData<Product[]>(queryKey)

      const optimisticProduct: Product = {
        id: Math.floor(Math.random() * -100000),
        name: newProductInput.name,
        description: newProductInput.description,
      }

      queryClient.setQueryData<Product[]>(queryKey, (old) => {
        return old ? [optimisticProduct, ...old] : [optimisticProduct]
      })

      return { previousProducts }
    },

    onError: (_err, _newProduct, context) => {
      if (context?.previousProducts) {
        queryClient.setQueryData(productKeys.lists(), context.previousProducts)
      }
    },

    onSettled: async () => {
      await queryClient.invalidateQueries({
        queryKey: productKeys.lists(),
      })
    },
  })
}
