#!/usr/bin/env python3
"""Assert the reported diagnostics, not just their total count."""
from collections import Counter
from pathlib import Path
import re
import subprocess
import sys

binary = str(Path(sys.argv[1]).resolve())
root = Path(__file__).resolve().parent
subprocess.run([binary, "--version"], check=True)
expected = {
    "nullable-receiver": Counter({
        "possible-method-access-on-null": 2,
        "mixed-return-statement": 1,
        "never-return": 1,
    }),
    "template-bounds": Counter({
        "missing-template-parameter": 2,
        "possibly-invalid-argument": 1,
    }),
    "enum-const-array": Counter({
        "invalid-method-access": 2,
        "mixed-return-statement": 1,
    }),
}
for case, diagnostics in expected.items():
    result = subprocess.run(
        [binary, "analyze", "--reporting-format", "short", "repro.php"], cwd=root / case,
        text=True, capture_output=True,
    )
    print(f"\n== {case} ==\n{result.stdout}{result.stderr}", flush=True)
    assert result.returncode == 1, (case, result.returncode)
    actual = Counter(re.findall(r"error\[([^\]]+)\]", result.stdout))
    assert actual == diagnostics, (case, actual, diagnostics)
print("Confirmed all three reported diagnostic sets.")
