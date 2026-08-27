export class ApiError extends Error {
  public readonly status: number
  constructor(message: string, status: number) {
    super(message)
    this.name = "ApiError"
    this.status = status;
  }
}

export async function apiFetch<T>(
  input: RequestInfo | URL,
  init?: RequestInit,
  parse?: (value: unknown) => T
): Promise<T> {
  const response = await fetch(input, {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      ...init?.headers,
    },
    ...init,
  })

  let body: unknown = null

  try {
    body = await response.json()
  } catch {
    // Some successful responses, such as 204, legitimately have no body.
  }

  if (!response.ok) {
    const message =
      typeof body === "object" &&
      body !== null &&
      "error" in body &&
      typeof body.error === "object" &&
      body.error !== null &&
      "message" in body.error &&
      typeof body.error.message === "string"
        ? body.error.message
        : "An unexpected API error occurred."

    throw new ApiError(message, response.status)
  }

  return parse ? parse(body) : (body as T)
}
