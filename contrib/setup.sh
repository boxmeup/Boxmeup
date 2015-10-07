#!/bin/sh

if [ -d .git ]; then
    cp contrib/pre-commit .git/hooks/pre-commit
    chmod +x .git/hooks/pre-commit
fi
