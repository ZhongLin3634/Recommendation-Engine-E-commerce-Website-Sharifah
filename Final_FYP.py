import pandas as pd

# File path for the modified Excel file
final_fyp_file_path = 'C:/wamp64/www/RE-Website/Final_FYP.xlsx'

# Read the Excel file into a pandas DataFrame
df_final_fyp = pd.read_excel(final_fyp_file_path)

# Print the DataFrame
print(df_final_fyp)
