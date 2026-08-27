import { Link, useLocation } from "react-router"
import { IconChevronRight } from "@tabler/icons-react"

export function Breadcrumbs() {
  const location = useLocation()

  const pathnames = location.pathname.split("/").filter((x) => x)

  if (pathnames.length === 0) return null

  return (
    <nav
      aria-label="breadcrumb"
      className="mb-4 flex items-center gap-2 text-base text-muted-foreground"
    >
      <Link
        to="/"
        className="transition-colors hover:text-foreground hover:underline"
      >
        Home
      </Link>

      {pathnames.map((value, index) => {
        const last = index === pathnames.length - 1
        const to = `/${pathnames.slice(0, index + 1).join("/")}`

        const displayName = value.charAt(0).toUpperCase() + value.slice(1)

        return (
          <div key={to} className="flex items-center gap-2">
            <span className="font-light text-foreground/40">
              <IconChevronRight stroke={1} className="size-4" />
            </span>
            {last ? (
              <span className="font-medium text-foreground" aria-current="page">
                {displayName}
              </span>
            ) : (
              <Link
                to={to}
                className="transition-colors hover:text-foreground hover:underline"
              >
                {displayName}
              </Link>
            )}
          </div>
        )
      })}
    </nav>
  )
}
