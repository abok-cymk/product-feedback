import {
  Alert,
  AlertTitle,
  AlertDescription,
} from "@/components/ui/alert"

export function ProductError() {
  return (
    <Alert variant="destructive">
      <AlertTitle>Unable to load products.</AlertTitle>
      <AlertDescription>
        We couldn't retrieve the products. Please try again later.
      </AlertDescription>
    </Alert>
  )
}