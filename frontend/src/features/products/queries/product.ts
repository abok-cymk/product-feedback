import { useSuspenseQuery } from "@tanstack/react-query";

import { getProducts } from "../api/products";

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