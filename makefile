utils:
	php -S localhost:8000 transformNotes.php

sync:
	python3 autoSync.py

.PHONY: utils sync
