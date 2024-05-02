utils:
	php -S localhost:8000 transformNotes.php

sync:
	python3 autoSync.py $(time)

.PHONY: utils sync
