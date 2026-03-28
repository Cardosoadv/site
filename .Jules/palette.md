## 2024-05-18 - Autocomplete for Accessibility
**Learning:** Adding `autocomplete` attributes is a WCAG 2.1 Success Criterion (1.3.5 Identify Input Purpose) that significantly improves UX for users with cognitive impairments and makes form completion faster for everyone.
**Action:** Always add appropriate `autocomplete` tokens (e.g., `name`, `email`, `tel`) to common personal data fields in forms.

## 2026-03-27 - Descriptive Link Text for Accessibility
**Learning:** Using generic link text like "Read more" or "See more" fails WCAG 2.4.4 (Link Purpose) because it lacks context for screen reader users who navigate by list of links. Providing unique context via `aria-label` or better link text is a critical accessibility requirement.
**Action:** When using repetitive "call to action" links in loops (like news grids or feature lists), always include descriptive context using `aria-label` that includes the specific item's title or name.
