import sys

def check_duplicate_lines_in_file(filename):
    try:
        # Open the file and read lines
        with open(filename, 'r') as file:
            lines = file.readlines()
        
        # Dictionary to store line occurrences
        line_counts = {}
        
        # Iterate through lines
        for line in lines:
            # Remove any trailing whitespace (including newlines)
            line = line.strip()
            
            if line in line_counts:
                # Notify if line appears again
                print(f"Duplicate found: '{line}'")
            else:
                # Add line to dictionary if it's the first time seen
                line_counts[line] = 1
    except FileNotFoundError:
        print(f"Error: The file '{filename}' was not found.")
    except Exception as e:
        print(f"An error occurred: {e}")

if __name__ == "__main__":
    # Check if the user provided a filename argument
    if len(sys.argv) < 2:
        print("Usage: python check_duplicate_lines.py <filename>")
    else:
        # Take the filename from the command-line argument
        filename = sys.argv[1]
        check_duplicate_lines_in_file(filename)
