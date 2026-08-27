import { useTransition } from "react";
import { useNavigate } from "react-router";

export function useAppNavigation() {
  const [isPending, startTransition] = useTransition();
  const navigate = useNavigate();

  function navigateTo(to: string) {
    startTransition(() => {
      navigate(to);
    });
  }

  return {
    isPending,
    navigateTo,
  };
}