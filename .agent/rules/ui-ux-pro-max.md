# Mandatory UI/UX Design System Policy — Rush Parcel UK

## Mandatory UI/UX Pro Max Skill Rule

**CRITICAL MANDATE FOR ALL AGENTS AND DEVELOPERS**:
For every UI/UX or design-related task (creating, redesigning, improving, polishing, or modifying pages, components, dashboards, cards, tables, forms, navigation, modals, typography, colors, spacing, responsive layouts, mobile interfaces, visual hierarchy, animations, empty/loading/error states, or accessibility), you **MUST** invoke and use the **UI/UX Pro Max Skill** before making design decisions or writing implementation code.

---

### UI/UX Skill Location & Execution
- **Workspace Skill Paths**: `.gemini/skills/ui-ux-pro-max/` and `.agent/skills/ui-ux-pro-max/`
- **Search Engine Execution**:
  ```bash
  python .gemini/skills/ui-ux-pro-max/scripts/search.py "<query>" --domain <domain>
  ```
  *(Or via Laragon Python: `& "C:\laragon\bin\python\python-3.13\python.exe" "e:\rushparcel\.gemini\skills\ui-ux-pro-max\scripts\search.py" "<query>" --domain <domain>`)*

---

### Required Design Workflow
For every UI/UX task, follow this strict sequence:
1. **Understand & Inspect**: Analyze requirements and inspect existing Rush Parcel UI component styling.
2. **Consult UI/UX Pro Max Skill**: Query the local skill database for product type (`--domain product`), UI styles (`--domain style`), colors (`--domain color`), typography (`--domain typography`), UX guidelines (`--domain ux`), or stack guidelines (`--stack html-tailwind`).
   - For new pages/systems: Run `--design-system -p "RushParcel"`
3. **Establish Design Direction**: Plan visual hierarchy, grid layout, color tokens, typography pairing, micro-interactions, and responsive behavior.
4. **Implement Code**: Write high-density, professional UI components preserving existing backend routes, APIs, and business logic.
5. **Review & Refine**: Verify output against the skill pre-delivery checklist (contrast >= 4.5:1, touch targets >= 44px, focus rings, smooth 150-250ms transitions, responsive layout).

---

### Core Principles
- **No Blind Redesigns**: Preserve existing business logic, database queries, and functional contracts.
- **SaaS Quality**: Avoid generic card grids, excessive whitespace, random gradients, or oversized low-density text.
- **Accessibility & Polish**: Enforce visible focus states, explicit form labels, and SVG icons.

