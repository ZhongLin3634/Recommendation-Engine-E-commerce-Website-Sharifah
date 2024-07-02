import pandas as pd
from surprise import Dataset, Reader, SVD
from surprise.model_selection import train_test_split
from surprise import accuracy

# Load the dataset
df = pd.read_excel("Final_FYP.xlsx")

# Choose relevant columns for collaborative filtering
df_cf = df[['No.', 'Date', 'NBGA', 'NBGD', 'NBGK', 'NGK', 'SSK', 'RD', 'RDm', 'RM', 'STIB', 'NL', 'NGU', 'NGIM', 'NGS', 'NGA', 'NGD', 'KA', 'KD', 'TAM', 'DS/NP', 'NBG', 'NBH', 'NBT', 'NBB', 'PKKI', 'PNGK', 'PNBG', 'PMK', 'PAP', 'PST', 'PMTR', 'PMG', 'TGA', 'TGR', 'Santan']]

# Load data into Surprise's Dataset
reader = Reader(rating_scale=(0, df_cf['Total Order'].max()))
data = Dataset.load_from_df(df_cf[['No.', 'NBGA', 'NBGD', 'NBGK', 'NGK', 'SSK', 'RD', 'RDm', 'RM', 'STIB', 'NL', 'NGU', 'NGIM', 'NGS', 'NGA', 'NGD', 'KA', 'KD', 'TAM', 'DS/NP', 'NBG', 'NBH', 'NBT', 'NBB', 'PKKI', 'PNGK', 'PNBG', 'PMK', 'PAP', 'PST', 'PMTR', 'PMG', 'TGA', 'TGR', 'Santan', 'Total Order']], reader)

# Split the data into training and testing sets
trainset, testset = train_test_split(data, test_size=0.5, random_state=42)

# Initialize SVD (Singular Value Decomposition) algorithm
model = SVD()

# Train the model on the training set
model.fit(trainset)

# Make predictions on the test set
predictions = model.test(testset)

# Evaluate accuracy
accuracy.rmse(predictions)

# Example: Get recommendations for a specific user (e.g., user with ID 1)
user_id = 1
user_items = df_cf[df_cf['No.'] == user_id]['Product'].tolist()

for item in user_items:
    if item not in trainset.to_inner_iid(item):
        predicted_rating = model.predict(user_id, trainset.to_inner_iid(item))
        print(f"Predicted rating for {item}: {predicted_rating.est}")
