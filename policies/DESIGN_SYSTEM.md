1. Design System Principles (Non‑Negotiable)
Consistency > Creativity

Neutral > Decorative

Readability > Visual flair

Professional > Trendy

Simple > Flashy

This is an HR system, not a marketing site.

2. Color Palette (Strict)
2.1 Primary Brand Colors
Purpose	Color	HEX
Primary	Navy Blue	#1E293B
Primary Hover	Dark Navy	#0F172A
Accent	Soft Blue	#3B82F6
Accent Hover	Deep Blue	#2563EB
Rules:

Use Primary for headers, navbars

Use Accent for buttons and links

Never introduce new brand colors

2.2 Neutral / Background Colors
Purpose	Color	HEX
Page Background	Light Gray	#F8FAFC
Card Background	White	#FFFFFF
Border / Divider	Light Border	#E5E7EB
Muted Text	Gray	#6B7280
Rules:

Page background must always be #F8FAFC

Cards must always be white

No gradients allowed

2.3 Status Colors (Limited Use)
Status	Color	HEX
Success	Green	#16A34A
Warning	Amber	#F59E0B
Error	Red	#DC2626
Info	Blue	#2563EB
Rules:

Use only for labels, badges, alerts

Never use status colors for layout

3. Typography Rules (Strict)
3.1 Font Family
Primary Font

font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
Rules:

Use one font family only

No decorative or script fonts

No mixing fonts across pages

3.2 Font Sizes
Element	Size
Page Title	24px
Section Heading	18px
Card Title	16px
Body Text	14px
Small / Meta Text	12px
Rules:

Do not invent font sizes

Do not scale text arbitrarily

Use Bootstrap utility classes where possible

3.3 Font Weight
Usage	Weight
Headings	600
Normal Text	400
Muted Text	400
Buttons	500
Rules:

No ultra‑bold text

No light/thin text

4. Spacing System (Very Important)
4.1 Spacing Scale (Only These Values)
Use multiples of 4px only:

4px, 8px, 12px, 16px, 24px, 32px
Rules:

No arbitrary spacing (e.g. 13px, 27px)

Prefer Bootstrap spacing utilities (m-*, p-*)

Consistent spacing across all pages

4.2 Layout Spacing Rules
Section spacing: 24px

Card padding: 16px

Form field spacing: 12px

Button spacing: 8px

5. Border & Radius Rules
5.1 Border Style
border: 1px solid #E5E7EB;
Rules:

No thick borders

No colored borders unless status‑based

5.2 Border Radius
Element	Radius
Cards	8px
Buttons	6px
Inputs	6px
Badges	12px
Rules:

No sharp edges

No excessive rounding

6. Shadows & Elevation
6.1 Allowed Shadow (Cards Only)
box-shadow: 0 1px 2px rgba(0,0,0,0.05);
Rules:

Shadows only for cards/modals

No heavy or floating shadows

No neumorphism or glow effects

7. Buttons (Consistency Rules)
7.1 Button Types
Type	Usage
Primary	Main action
Secondary	Secondary action
Danger	Destructive actions
Rules:

One primary action per screen

Buttons must look clickable

No icon‑only buttons for critical actions

7.2 Button Sizing
Height: ~38–40px

Padding: 8px 16px

Font size: 14px

8. Forms & Inputs
8.1 Input Rules
All inputs must have labels

Placeholder ≠ label

Inputs must be same height

No floating labels

8.2 Form Layout
One column on mobile

Two columns on larger screens (where appropriate)

Clear section grouping

9. Tables
9.1 Table Rules
Use Bootstrap tables

Header background: #F1F5F9

Row hover allowed (subtle)

No zebra striping unless needed

10. Icons (Optional)
Rules:

Icons are optional

If used, keep consistent style

Do not mix icon libraries

Icons must never replace text.

11. Responsiveness Rules
Mobile‑first

Must not break between 200–400px

Tables may scroll horizontally

No fixed widths

12. Forbidden Design Practices (Critical)
You MUST NOT:

Introduce new colors

Use gradients

Use animations for core actions

Mix font families

Use flashy UI elements

Break spacing scale

13. Enforcement Rule
Any UI that:

Violates this design system

Introduces unapproved styles

Looks inconsistent across pages

Is invalid and must be corrected.