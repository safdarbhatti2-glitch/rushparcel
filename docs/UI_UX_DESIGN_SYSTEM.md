# UI/UX Pro Max Skill & Design System Documentation

## Overview

The **UI/UX Pro Max Skill** is integrated into this project as the mandatory design system intelligence and decision framework for all UI/UX and visual interface work.

---

## Skill Installation Location

The skill is installed locally within the workspace repository:
- **Primary Path**: `.gemini/skills/ui-ux-pro-max/`
- **Secondary Path**: `.agent/skills/ui-ux-pro-max/`

### Internal Structure:
- `SKILL.md` — Agent instructions & domain priority hierarchy.
- `data/` — Canonical searchable databases (`styles.csv`, `colors.csv`, `typography.csv`, `products.csv`, `ux.csv`, `landing.csv`, `chart.csv`, `stacks/`).
- `scripts/` — Python search engine CLI (`search.py`, `core.py`, `design_system.py`).
- `references/` — Detailed reference guidelines (`quick-reference.md`, `pro-rules.md`).

---

## Invocation & Usage Guidelines

Antigravity or any developer agent working on this repository **MUST** trigger the UI/UX Pro Max search engine before making design decisions or writing UI code.

### Search Command Usage:
```bash
# Run via local Python interpreter
python .gemini/skills/ui-ux-pro-max/scripts/search.py "<query>" --domain <domain>

# On Windows / Laragon environment:
& "C:\laragon\bin\python\python-3.13\python.exe" "e:\rushparcel\.gemini\skills\ui-ux-pro-max\scripts\search.py" "<query>" --domain <domain>
```

### Available Search Domains:
- `product`: Product type recommendations (SaaS, logistics, dashboard, e-commerce)
- `style`: Visual UI styles (minimalism, glassmorphism, flat, OLED dark mode)
- `color`: Curated color palettes with primary, accent, background, and card tokens
- `typography`: Google Fonts pairings and CSS import code
- `ux`: Best practices, usability rules, and anti-patterns to avoid
- `landing`: High-conversion page structures and CTA strategies
- `chart`: Data visualization and chart recommendations
- `icons`: Icon library recommendations (Heroicons, Lucide, Phosphor)

### Generating a Full Design System:
```bash
python .gemini/skills/ui-ux-pro-max/scripts/search.py "uk parcel courier logistics dashboard" --design-system -p "RushParcel"
```

---

## Mandatory Design Workflow

Whenever tasked with UI/UX tasks (creating pages, modifying components, styling forms, tables, cards, navigation, or responsive layouts), follow this 6-step workflow:

1. **Understand Request**: Identify the target user, component type, and required functionality.
2. **Inspect Existing UI**: Understand current Rush Parcel styles, components, and layout structures.
3. **Execute Skill Query**: Run `search.py` for the relevant domain or design-system query.
4. **Establish Design Direction**: Select visual hierarchy, color palette, typography scale, spacing grid, micro-interactions, and responsive rules.
5. **Implement Code**: Write clean, accessible code while preserving all existing backend logic, APIs, and routes.
6. **Verify & Refine**: Verify output against the pre-delivery checklist (contrast, 44px+ touch targets, focus states, responsive layout).

