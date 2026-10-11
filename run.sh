#!/bin/sh
# Run all three repros against a mago binary.
# usage: run.sh <mago-binary>
# Prints the issue count per repro. Expected on mago 1.55.0 (red):
#   nullable-receiver: 4 errors (2 of them false positives)
#   template-bounds:   3 errors (1 of them a false positive)
#   enum-const-array:  3 errors (all false positives)
set -u
B=$(readlink -f "$1")
"$B" --version
here=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
for r in nullable-receiver template-bounds enum-const-array; do
  out=$(cd "$here/$r" && "$B" analyze repro.php 2>/dev/null)
  printf '%s: %s\n' "$r" "$(echo "$out" | grep -E '^error:' || echo 'no issues')"
done
