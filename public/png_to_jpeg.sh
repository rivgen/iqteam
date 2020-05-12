#!/bin/bash

INPUT_FILE=${1}
OUTPUT_FILE=${2}

convert ${INPUT_FILE} -quality 90 ${OUTPUT_FILE}
mv ${INPUT_FILE} ${INPUT_FILE}.origin
mv ${OUTPUT_FILE} ${INPUT_FILE} 
