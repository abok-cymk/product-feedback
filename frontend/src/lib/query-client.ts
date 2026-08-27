import { QueryClient } from "@tanstack/react-query"

export const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      /** Avoid surprising duplicate requests while developing. */
      staleTime: 30_000,
      refetchOnWindowFocus: false,
    },
  },
})
