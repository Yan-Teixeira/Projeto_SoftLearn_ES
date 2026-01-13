# Security Policy

This is a web-based educational project (Laravel + TailwindCSS). Security matters for user data privacy, academic integrity, and the reliability of the gamification system. Please report vulnerabilities responsibly.

## Supported Versions

Security fixes are provided only for the latest version on the default branch.

| Version/Branch | Supported |
| :--- | :--- |
| `main` | Yes |
| Older tags/branches | No |

## Reporting a Vulnerability

If you find a security issue, please **do not open a public issue** right away.

1. Contact the maintainers privately (email): **[andersonwya4@gmail.com]**
2. Subject: `SECURITY REPORT - SoftLearn ES Platform`
3. Include:
   - Clear reproduction steps (PoC - Proof of Concept)
   - Affected URLs or Endpoints
   - Screenshots or logs (if available)

A response is expected within **48–72 hours**.

## Scope (Web / Software Engineering)

### In scope (examples)

- **Injection Vulnerabilities** (SQL Injection, Command Injection) that could compromise the database.
- **Cross-Site Scripting (XSS)** that allows executing arbitrary scripts in other users' browsers.
- **Broken Access Control** (e.g., a student accessing teacher panels or modifying grades).
- **Gamification Exploits** (e.g., bypassing logic to artificially inflate XP, Levels, or Badges).
- **Sensitive Data Exposure** (e.g., leaking user emails or hashed passwords).

### Out of scope (examples)

- **DDoS Attacks** (Distributed Denial of Service).
- **Social Engineering** (phishing) against users or maintainers.
- **Self-XSS** (attacks that require the user to paste code into their own console).
- **Physical access** to the server infrastructure.

## Secure Development Guidelines

- **Input Validation**: Validate and sanitize all form inputs using Laravel's Form Requests.
- **Output Escaping**: Ensure all user-generated content is escaped in Blade templates to prevent XSS.
- **Authentication**: Use standard Laravel authentication mechanisms; do not roll your own crypto.
- **Secrets Management**: Never commit `.env` files or API keys to the repository.
- **Gamification Logic**: Validate game actions on the server-side, never trust the client state alone.

## Disclosure

After a fix is released, a brief security note may be published in a release/changelog, with reporter credit if approved.
