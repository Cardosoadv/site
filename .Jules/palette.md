## 2024-03-02 - Form Semantics and Accessibility
**Learning:** Found that the contact form was using `<div>` wrappers instead of a proper `<form>` element, and inputs lacked associated `<label>` `for`/`id` links, making it inaccessible to screen readers and difficult to click on mobile.
**Action:** Always wrap input collections in a `<form>` element and ensure every `<label>` is explicitly tied to its input via `for` and `id` attributes. Added `type="submit"` to the button to enable proper form submission handling.
