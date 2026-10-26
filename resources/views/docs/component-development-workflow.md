# Component Development Workflow

Develop components and compositions through JTB, Gotime, and the application,
in that order. Reuse existing work where it meets the requirement.

## 1. JTB

- Identify the component or composition needed.
- Create or refine its design, markup, and styling in a JTB example or showcase.
- Verify the required appearance and behaviour, including responsive behaviour where needed.
- Create or update the relevant documentation.
- Update JTB status to reflect what has been verified and documented.

## 2. Gotime

- Decide whether the JTB example needs a reusable Gotime component.
- Create or refine the component and its behaviour using the JTB example as the baseline.
- Verify the component and the pieces it composes against that baseline.
- Create or update the relevant documentation.
- Update Gotime status to reflect what has been verified and documented.

JTB and Gotime follow the same cycle: build, verify, document, and update status.

## 3. Application

- Copy the JTB example into the application and confirm it renders correctly.
- Replace its pieces with Gotime components incrementally, checking appearance and behaviour after each replacement.
- Compose the pieces for the application's requirements.
- Verify the integrated result and update website status.

Keep reusable styling and design in JTB, reusable components and behaviour in
Gotime, and application-specific composition in the application. Resolve design
changes in JTB first.

## Incremental Work

This describes the complete workflow, not a requirement to finish every
capability before using a component.

- Address what the current composition needs and resolve issues that block its use.
- Record other gaps and outstanding reviews in the relevant status tracker.
- Existing components may be used while their broader review remains outstanding.
- Integration into the website does not mean the underlying package review is complete.
