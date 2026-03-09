## 2024-05-18 - Autocomplete for Accessibility
**Learning:** Adding `autocomplete` attributes is a WCAG 2.1 Success Criterion (1.3.5 Identify Input Purpose) that significantly improves UX for users with cognitive impairments and makes form completion faster for everyone.
**Action:** Always add appropriate `autocomplete` tokens (e.g., `name`, `email`, `tel`) to common personal data fields in forms.

## 2026-03-09 - Accessible Navigation Links
**Learning:** Using a `<button>` with an `onclick` JavaScript event for site navigation breaks standard web expectations and accessibility. Users cannot right-click to open in a new tab, and screen readers may announce it as an action rather than a navigation link.
**Action:** Always use semantic `<a>` tags with valid `href` attributes for navigation, styling them to look like buttons if visually required, rather than forcing `<button>` elements to act like links.