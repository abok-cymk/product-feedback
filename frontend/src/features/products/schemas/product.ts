import { z } from "zod";

export const productSchema = z.object({
  id: z.number().int(),
  name: z.string(),
  description: z.string(),
});

export const productsResponseSchema = z.object({
  data: z.array(productSchema),
});

export const productResponseSchema = z.object({
  data: productSchema,
});

export type Product = z.infer<typeof productSchema>;