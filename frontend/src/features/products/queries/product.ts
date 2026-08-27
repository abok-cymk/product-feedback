import { useMutation, useQueryClient, useSuspenseQuery } from "@tanstack/react-query";

import { createProduct, getProducts, type CreateProductInput } from "../api/products";

export const productKeys = {
  all: ["products"] as const,
  lists: () => [...productKeys.all, "list"] as const,
};

export function useProducts() {
  return useSuspenseQuery({
    queryKey: productKeys.lists(),
    queryFn: getProducts,
  });
}

export function useCreateProduct() {
  const queryClient = useQueryClient()

  return useMutation({
    mutationFn: (input: CreateProductInput) => createProduct(input),

    onSuccess: async () => {
      await queryClient.invalidateQueries({
        queryKey: productKeys.lists(),
      })
    },
  })
}