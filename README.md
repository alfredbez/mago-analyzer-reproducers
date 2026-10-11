# Mago analyzer reproducers

Three small, independent reproducers for Mago 1.55.0:

| Directory | Unexpected diagnostic | Expected behaviour |
| --- | --- | --- |
| `nullable-receiver` | `mixed-return-statement`, `never-return` | Keep the declared return type; retain both null-access warnings. |
| `template-bounds` | `possibly-invalid-argument` | Resolve forwarded template bounds; retain both missing-template warnings. |
| `enum-const-array` | `invalid-method-access`, `mixed-return-statement` | Calling an enum method after the `isset` guard is valid. |

Run `mago analyze repro.php` inside any directory, or check all three:

```sh
python3 verify.py /path/to/mago
```

Requires Python 3 and Mago. CI downloads the pinned Linux x86_64 release
1.55.0 and checks the exact diagnostic identifiers and counts. A green
reproducer workflow means the reported bugs were reproduced, not fixed.

Each proposed fix is independent; applying one should only change its own
reproducer's diagnostics. No application dependencies or configuration needed.
